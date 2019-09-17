## [2.0.6](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.5...v2.0.6) (2019-09-17)


### Bug Fixes

* **dep-bump:** switch to @hexonet/semantic-release-whmcs ([7a31e5d](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/7a31e5d))

## [2.0.5](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.4...v2.0.5) (2019-09-16)


### Bug Fixes

* **release process:** fix git-plugin assets ([1bc7ef0](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/1bc7ef0))
* **release process:** fix prepareCmd ([6401514](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/6401514))
* **release process:** review plugin list ([03e2bb0](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/03e2bb0))
* **release process:** reviewed config and process (Travis, semantic-release) ([415026f](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/415026f))

## [2.0.4](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.3...v2.0.4) (2019-09-13)


### Bug Fixes

* **dep-bump:** try semantic-release-whmcs v1.0.4 ([7332ae3](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/7332ae3))

## [2.0.3](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.2...v2.0.3) (2019-09-12)


### Bug Fixes

* **dep-bump:** semantic-release-whmcs to 1.0.3 ([fdd09d3](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/fdd09d3))

## [2.0.2](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.1...v2.0.2) (2019-09-12)


### Bug Fixes

* **semantic-release:** introducing plugin for whmcs marketplace publishing ([5ef810d](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/5ef810d))

## [2.0.1](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.0...v2.0.1) (2019-05-08)


### Bug Fixes

* **jscript:** fix issue displaying the number of domains in textarea ([b9e94be](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/b9e94be))

# [2.0.0](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.4.2...v2.0.0) (2019-05-03)


### Code Refactoring

* **shared-lib:** use libs provided in ispapi registrar module instead. ([73e4b28](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/73e4b28))


### BREAKING CHANGES

* **shared-lib:** We moved several libraries to the ispapi registrar module for code reuse. Therefore
we define now v1.7.1 as minimum version requirement of the ispapi registrar module.

## [1.4.2](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.4.1...v1.4.2) (2019-04-24)


### Bug Fixes

* **pkg:** add check for class existance before loading ([b393914](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/b393914))

## [1.4.1](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.4.0...v1.4.1) (2019-04-11)


### Bug Fixes

* **logo:** use PNG format ([dd63386](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/dd63386))

# [1.4.0](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.3.2...v1.4.0) (2019-03-26)


### Features

* **pkg:** move some logic to javascript to improve page load ([2fd9b9d](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/2fd9b9d))

## [1.3.2](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.3.1...v1.3.2) (2019-03-22)


### Bug Fixes

* **dep-bump:** whmcs-ispapi-helper@1.3.3; add check for empty phone number ([fe974a7](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/fe974a7))

## [1.3.1](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.3.0...v1.3.1) (2019-03-22)


### Bug Fixes

* **dep-bump:** whmcs-ispapi-helper@1.3.2, migration to localAPI ([06ad8ba](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/06ad8ba))

# [1.3.0](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.2.0...v1.3.0) (2019-03-08)


### Features

* **CI:** auto-add new version on WHMCS Marketplace ([08e5b61](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/08e5b61))

# [1.2.0](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.1.1...v1.2.0) (2019-03-06)


### Features

* **client:** import now generates random passwords per client ([c5f943c](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/c5f943c))

## [1.1.1](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.1.0...v1.1.1) (2019-03-01)


### Bug Fixes

* **pandoc:** fix travis ci configuration ([cfc148a](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/cfc148a))
* **pandoc:** review travis cfg ([6fb0c16](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/6fb0c16))
* **pandoc:** switch from apt installation to dpkg ([4838257](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/4838257))

# [1.1.0](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.0.2...v1.1.0) (2019-03-01)


### Features

* **docs:** add HTML Documentation to archives ([c3ff4c1](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/c3ff4c1))

## [1.0.2](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.0.1...v1.0.2) (2019-02-28)


### Bug Fixes

* **Makefile:** review archive structure ([fe2d214](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/fe2d214))

## [1.0.1](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v1.0.0...v1.0.1) (2019-02-28)


### Bug Fixes

* **dep-bump:** whmcs-ispapi-helper to v1.0.6 ([bcdbe2c](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/bcdbe2c))

# 1.0.0 (2019-02-27)


### Bug Fixes

* **PDO:** rewrite for better PDO usage incl. NULL value replacement ([e3e9914](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/e3e9914))
* **pkg:** domain list output in textarea ([bdeab61](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/bdeab61))
