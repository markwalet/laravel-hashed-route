# Release Notes

## [Unreleased](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.8...master)

### Added
- Added clover coverage to CI.

### Changed
- Moved the `RequiresConfigurationKeys` trait to the root namespace.
- Moved codec factory to root namespace.
- Reverse the order of the parameters in the `RequiresConfigurationKeys::require()` method.
- Increased minimum PHP version to `>=7.0.12`.

## [1.1.7](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.5...v1.1.7)

### Added
- Added a test to ensure correct behaviour for route model binding.

## [1.1.6](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.5...v1.1.6)

### Fixed
- Fixed numeric constraint in optimus codec.

## [1.1.5](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.4...v1.1.5)

### Added
- Added automatic route model binding.

## [1.1.4](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.2...v1.1.4)

### Fixed
- Fixed publish path for config.

## [1.1.2](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.1...v1.1.2)

### Added
- Added optimus codec

## [1.1.1](https://github.com/markwalet/laravel-hashed-route/compare/v1.1.0...v1.1.1)

### Added
- Added base64 codec
- Added documentation for available drivers.

## [1.1.0](https://github.com/markwalet/laravel-hashed-route/compare/v1.0.0...v1.1.0)

### Changed
- Rename transformer to codec.
