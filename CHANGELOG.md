# Release Notes

## [Unreleased](https://github.com/markwalet/laravel-hashed-route/compare/v2.0.0...master)

## [v2.0.0](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.8...2.0.0)

### Added
- Added clover coverage to CI.
- Added Laravel 5.8 to CI.

### Changed
- Moved the `RequiresConfigurationKeys` trait to the root namespace.
- Moved codec factory to root namespace.
- Reverse the order of the parameters in the `RequiresConfigurationKeys::require()` method.
- Increased minimum PHP version to `>=7.0.12`.

## [v1.1.7](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.5...v1.1.7)

### Added
- Added a test to ensure correct behaviour for route model binding.

## [v1.1.6](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.5...v1.1.6)

### Fixed
- Fixed numeric constraint in optimus codec.

## [v1.1.5](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.4...v1.1.5)

### Added
- Added automatic route model binding.

## [v1.1.4](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.2...v1.1.4)

### Fixed
- Fixed publish path for config.

## [v1.1.2](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.1...v1.1.2)

### Added
- Added optimus codec

## [v1.1.1](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.0...v1.1.1)

### Added
- Added base64 codec
- Added documentation for available drivers.

## [v1.1.0](https://github.com/markwalet/laravel-hashed-route/compare/v1.0.0...v1.1.0)

### Changed
- Rename transformer to codec.
