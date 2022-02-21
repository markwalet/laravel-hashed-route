# Release Notes

## [Unreleased](https://github.com/markwalet/laravel-hashed-route/compare/v2.7.0...master)

## Changed
- Removed application dependency from `HashedRouteManager` ([#18](https://github.com/markwalet/laravel-hashed-route/issues/18))

## [v2.7.0 (2022-02-08)](https://github.com/markwalet/laravel-hashed-route/compare/v2.6.0...v2.7.0)

### Added
- Added Laravel 9 support.

## [v2.6.0 (2021-12-22)](https://github.com/markwalet/laravel-hashed-route/compare/v2.5.0...v2.6.0)

## Added
- Added PHP 8.1 support.

## Removed
- Removed PHP 7.3 support.

## [v2.5.0 (2021-08-09)](https://github.com/markwalet/laravel-hashed-route/compare/v2.4.0...v2.5.0)

### Added
- Added Hashids 4 support.
- Added PHP 8 support.

### Removed
- Added Hashids 2 support.
- Removed PHP 7.2 support.

## [v2.4.0 (2020-10-21)](https://github.com/markwalet/laravel-hashed-route/compare/v.2.3.2...v2.4.0)

### Added
- Added Laravel 8 support.

## [v2.3.2 (2020-08-04)](https://github.com/markwalet/laravel-hashed-route/compare/v2.3.1...v.2.3.2)

### Fixed
- Fixed a bug in the PHPUnit test suite.

## [v2.3.1 (2020-03-24)](https://github.com/markwalet/laravel-hashed-route/compare/v2.3.0...v2.3.1)

### Added
- Added a `.gitattributes` file to shrink down releases.

## [v2.3.0 (2020-03-20)](https://github.com/markwalet/laravel-hashed-route/compare/v2.2.0...v2.3.0)

### Added
- Added Github Actions integration.
- Added PHP 7.4 support.
 
### Removed
- Removed support for Laravel 5.
- Removed support for PHP 7.0
- Removed support for PHP 7.1
- Removed Travis integration.

## [v2.2.0 (2020-03-12)](https://github.com/markwalet/laravel-hashed-route/compare/v2.1.0...v2.2.0)

### Added
- Add support for Laravel 7. ([#6](https://github.com/markwalet/laravel-hashed-route/issues/6))

### Added
- Added Codecov integration.

### Removed
- Removed Coveralls integration.

### Fixed
- Fixed the link to travis CI in the README. 

## [v2.1.0 (2019-09-17)](https://github.com/markwalet/laravel-hashed-route/compare/v2.0.0...v2.1.0)

### Added
- Added support for Laravel 6.
- Added StyleCI integration.

## [v2.0.0 (2019-08-02)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.8...v2.0.0)

### Added
- Added clover coverage to CI.
- Added Laravel 5.8 to CI.

### Changed
- Moved the `RequiresConfigurationKeys` trait to the root namespace.
- Moved codec factory to root namespace.
- Reverse the order of the parameters in the `RequiresConfigurationKeys::require()` method.
- Increased minimum PHP version to `>=7.0.12`.

## [v1.1.8 (2018-08-03)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.7...v1.1.8)

### Added
- Added support for `hashids/hashids:~3.0`.
- Added support for `phpunit/phpunit:~7.0`.

## [v1.1.7 (2017-12-01)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.6...v1.1.7)

### Added
- Added a test to ensure correct behaviour for route model binding.

## [v1.1.6 (2017-12-01)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.5...v1.1.6)

### Fixed
- Fixed numeric constraint in optimus codec.

## [v1.1.5 (2017-12-01)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.4...v1.1.5)

### Added
- Added automatic route model binding.

## [v1.1.4 (2017-12-01)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.3...v1.1.4)

### Fixed
- Fixed publish path for config.

## [v1.1.3 (2017-12-01)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.2...v1.1.3)

### Changed
- Move optimus configuration options to `.env` file.

## [v1.1.2 (2017-12-01)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.1...v1.1.2)

### Added
- Added optimus codec.

## [v1.1.1 (2017-12-01)](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.0...v1.1.1)

### Added
- Added base64 codec
- Added documentation for available drivers.

## [v1.1.0 (2017-12-01)](https://github.com/markwalet/laravel-hashed-route/compare/v1.0.0...v1.1.0)

### Changed
- Rename transformer to codec.
