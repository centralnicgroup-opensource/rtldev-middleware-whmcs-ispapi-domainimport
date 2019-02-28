ISPAPI_MODULE_VERSION := $(shell php -r 'include "modules/addons/ispapidomainimport/ispapidomainimport.php"; print $$module_version;')
FOLDER := pkg/whmcs-ispapi-domainimport-$(ISPAPI_MODULE_VERSION)

clean:
	rm -rf $(FOLDER)

buildsources:
	mkdir -p $(FOLDER)
	cp -R modules/addons/ispapidomainimport/* $(FOLDER)
	rm -rf $(FOLDER)/lib/vendor/hexonet/whmcs-ispapi-helper/.git
	cp README.md HISTORY.md CONTRIBUTING.md LICENSE $(FOLDER)

buildlatestzip:
	cp pkg/whmcs-ispapi-domainimport.zip ./whmcs-ispapi-domainimport-latest.zip # for downloadable "latest" zip by url

zip:
	@echo $(ISPAPI_MODULE_VERSION);
	rm -rf pkg/whmcs-ispapi-domainimport.zip
	@$(MAKE) buildsources
	cd pkg && zip -r whmcs-ispapi-domainimport.zip whmcs-ispapi-domainimport-$(ISPAPI_MODULE_VERSION)
	@$(MAKE) clean

tar:
	@echo $(ISPAPI_MODULE_VERSION)
	rm -rf pkg/whmcs-ispapi-domainimport.tar.gz
	@$(MAKE) buildsources
	cd pkg && tar -zcvf whmcs-ispapi-domainimport.tar.gz whmcs-ispapi-domainimport-$(ISPAPI_MODULE_VERSION)
	@$(MAKE) clean

allarchives:
	@echo $(ISPAPI_MODULE_VERSION)
	rm -rf pkg/whmcs-ispapi-domainimport.zip
	rm -rf pkg/whmcs-ispapi-domainimport.tar
	@$(MAKE) buildsources
	cd pkg && zip -r whmcs-ispapi-domainimport.zip whmcs-ispapi-domainimport-$(ISPAPI_MODULE_VERSION) && tar -zcvf whmcs-ispapi-domainimport.tar.gz whmcs-ispapi-domainimport-$(ISPAPI_MODULE_VERSION)
	@$(MAKE) buildlatestzip
	@$(MAKE) clean
