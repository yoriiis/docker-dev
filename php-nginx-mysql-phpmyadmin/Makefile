CERT_DOMAINS=local.app.com

# Function to install dependency with Brew only if not already installed
install_dependency = \
    @if [ ! -x $$(command -v $(1)) ]; then \
        echo "$(1) not found, installing..."; \
        brew install $(2); \
    else \
        echo "$(1) already installed"; \
    fi

.PHONY: install uninstall start stop

install: install-prerequisite install-certs install-composer update-hosts

install-prerequisite:
	@mkdir -p logs .docker/mysql config/certs
	$(call install_dependency, docker)
	$(call install_dependency, composer)
	$(call install_dependency, mkcert)
	$(call install_dependency, nss)
	$(call install_dependency, hostess)

install-composer:
	cd ./src && composer install && cd -

update-hosts:
	@echo "Updating /etc/hosts..."
	@sudo hostess add ${CERT_DOMAINS} 127.0.0.1

install-certs:
	@echo "Installing CA certificate..."
	@mkcert -install
	@mkcert -cert-file=config/certs/local.cert -key-file=config/certs/local.key $(CERT_DOMAINS)

start:
	docker-compose up -d

stop:
	docker-compose down

uninstall:
	@mkcert -uninstall
	@rm -rf ./.docker ./logs ./config/certs ./src/vendor
	@docker-compose rm --force --volumes
