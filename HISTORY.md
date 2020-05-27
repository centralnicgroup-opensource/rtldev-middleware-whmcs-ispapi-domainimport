## [3.0.1](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v3.0.0...v3.0.1) (2020-05-27)


### Bug Fixes

* **versioning:** move global defined version number directly into config method ([8b44199](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/8b44199992b989c2c06bb1a7154e85581a9b3d87))

# [3.0.0](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.12...v3.0.0) (2020-04-27)


### Code Refactoring

* **migration:** to support v3.x.x of the ispapi registrar module ([b724803](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/b7248038c79257d42efcd6bcd189e091814ab1e6))


### BREAKING CHANGES

* **migration:** compatible with ISPAPI registrar module v3.x.x

## [2.0.12](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.11...v2.0.12) (2020-03-30)


### Performance Improvements

* **create-client:** improved response messages ([ffcaf26](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/ffcaf26dd4fb9c515ff780effcb63fc505c5f5ce))

## [2.0.11](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.10...v2.0.11) (2019-11-29)


### Bug Fixes

* **smarty-variables:** to populate standard smarty variables ([95496d7](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/95496d7072f76182e9a34d73e003a8273bffbe50))

## [2.0.10](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.9...v2.0.10) (2019-11-28)


### Bug Fixes

* **paths:** to consider ROOTDIR and WEB_ROOT ([3e40842](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/3e4084280b4387b3e5706afac69f4b7c13237e84))

## [2.0.9](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.8...v2.0.9) (2019-09-18)


### Bug Fixes

* **release process:** give v1.1.0 of config module a try ([56ff5ed](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/56ff5ed))

## [2.0.8](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.7...v2.0.8) (2019-09-17)


### Bug Fixes

* **release process:** install pandoc 2 ([df535fd](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/df535fd))
* **travis:** use superuser privilege for pandoc installation ([59fe43c](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/59fe43c))

## [2.0.7](https://github.com/hexonet/whmcs-ispapi-domainimport/compare/v2.0.6...v2.0.7) (2019-09-17)


### Bug Fixes

* **release process:** use shareable configuration ([2614988](https://github.com/hexonet/whmcs-ispapi-domainimport/commit/2614988))

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
