ROOT := www
DRUSHMAKE := drush.make
DRUSH := drush8

update:
				#Apply any database updates required
				$(DRUSH) -r $(ROOT) -y updb
				#clear the cache
				$(DRUSH) -r $(ROOT) -y cache-rebuild

build: 	chmod drushmake patch

chmod:
				chmod a+w $(ROOT)/sites/default

drushmake:
				cd $(ROOT) && $(DRUSH) make --no-gitinfofile ../$(DRUSHMAKE) .

patch:

clean:
				rm -f $(ROOT)/update.php
				rm -f $(ROOT)/LICENSE.txt
				rm -f $(ROOT)/README.txt
				rm -f $(ROOT)/robots.txt
				rm -f $(ROOT)/example.gitignore
