COLOR_ENABLED ?= true
TEST_OUTPUT_STYLE ?= dot

## DIRECTORY AND FILE
BUILD_DIRECTORY ?= build
REPORTS_DIRECTORY ?= ${BUILD_DIRECTORY}/reports # Codestyle
PHPUNIT_COVERAGE_DIRECTORY ?= ${BUILD_DIRECTORY}/coverage-phpunit
PHPUNIT_UNIT_COVERAGE_FILE_PATH ?= ${PHPUNIT_COVERAGE_DIRECTORY}/unit.clover

## Commands options
### Composer
#COMPOSER_OPTIONS=
### Phpcs
PHPCS_REPORT_STYLE ?= full
PHPCS_DISABLE_WARNING ?= "false"
PHPCS_STANDARD_OPTION ?= "--standard=phpcs.xml.dist"
#PHPCS_REPORT_FILE=
#PHPCS_REPORT_FILE_OPTION=

# Enable/Disable color ouput
ifeq ("${COLOR_ENABLED}","true")
	PHPUNIT_COLOR_OPTION ?= --colors=always
	PHPCS_COLOR_OPTION ?= --colors
	COMPOSER_COLOR_OPTION ?= --ansi
else
	PHPUNIT_COLOR_OPTION ?= --colors=never
	PHPCS_COLOR_OPTION ?= --no-colors
	COMPOSER_COLOR_OPTION ?= --no-ansi
endif

ifeq ("${TEST_OUTPUT_STYLE}","pretty")
	PHPUNIT_OUTPUT_STYLE_OPTION ?= --testdox
else
	PHPUNIT_OUTPUT_STYLE_OPTION ?=
endif

ifdef COVERAGE_OUTPUT_STYLE
	export XDEBUG_MODE=coverage
	ifeq ("${COVERAGE_OUTPUT_STYLE}","html")
		PHPUNIT_COVERAGE_OPTION ?= --coverage-html ${PHPUNIT_COVERAGE_DIRECTORY}
	else ifeq ("${COVERAGE_OUTPUT_STYLE}","clover")
		PHPUNIT_COVERAGE_OPTION ?= --coverage-clover ${PHPUNIT_UNIT_COVERAGE_FILE_PATH}
        else
		PHPUNIT_COVERAGE_OPTION ?= --coverage-text
	endif
endif

ifneq ("${PHPCS_REPORT_FILE}","")
	PHPCS_REPORT_FILE_OPTION ?= --report-file=${PHPCS_REPORT_FILE}
endif

ifneq ("${PHPCS_DISABLE_WARNING}","true")
	PHPCS_DISABLE_WARNING_OPTION=
else
	PHPCS_DISABLE_WARNING_OPTION=-n
endif


.DEFAULT: build

## Project build (install and configure)
.PHONY: build
build: install configure

## Project installation
.PHONY: install
install:
	composer install ${COMPOSER_COLOR_OPTION} ${COMPOSER_OPTIONS} --prefer-dist --no-suggest --no-interaction

## project Configuration
.PHONY: configure
configure:
	./vendor/bin/phpcs --config-set ignore_warnings_on_exit 1

# Project tests
.PHONY: test
test: test-unit test-functional codestyle

.PHONY: coverage
coverage:
	COVERAGE_OUTPUT_STYLE=html make test

.PHONY: test-unit
ifdef PHPUNIT_COVERAGE_OPTION
test-unit: create-build-directories
endif
test-unit:
	./vendor/bin/phpunit ${PHPUNIT_COLOR_OPTION} ${PHPUNIT_OUTPUT_STYLE_OPTION} ${PHPUNIT_COVERAGE_OPTION} --testsuite technical

.PHONY: test-functional
ifdef PHPUNIT_COVERAGE_OPTION
test-functional: create-build-directories
endif
test-functional:
	echo "No functional test !"

.PHONY: codestyle
codestyle: create-build-directories
	./vendor/bin/phpcs ${PHPCS_DISABLE_WARNING_OPTION} ${PHPCS_STANDARD_OPTION} ${PHPCS_COLOR_OPTION} ${PHPCS_REPORT_FILE_OPTION} --report=${PHPCS_REPORT_STYLE}

.PHONY: codestyle-fix
codestyle-fix:
	./vendor/bin/phpcbf ${PHPCS_DISABLE_WARNING_OPTION} ${PHPCS_STANDARD_OPTION} ${PHPCS_COLOR_OPTION} ${PHPCS_REPORT_FILE_OPTION}

# Internal commands
.PHONY: create-build-directories
create-build-directories:
	mkdir -p ${PHPUNIT_COVERAGE_DIRECTORY} ${REPORTS_DIRECTORY}
