CERT_DOMAINS=local.app.com
PHP_FORMULA=php@8.1

# Function to install dependency with Brew only if not already installed
install_dependency = \
    @if [ ! -x $$(command -v $(1)) ]; then \
        echo "$(1) not found, installing..."; \
        brew install $(2); \
    else \
        echo "$(1) already installed"; \
    fi

.PHONY: install uninstall start stop

test:
	$(call install_dependency,composer)

install: install-prerequisite certs-install update-hosts

install-prerequisite:
	@mkdir -p logs .docker/mysql config/certs
	$(call install_dependency, ${PHP_FORMULA})
	$(call install_dependency, docker)
	$(call install_dependency, composer)
	$(call install_dependency, mkcert)
	$(call install_dependency, nss)
	$(call install_dependency, hostess)

update-hosts:
	@echo "Updating /etc/hosts..."
	@sudo hostess add ${CERT_DOMAINS} 127.0.0.1

certs-install:
	@echo "Installing CA certificate..."
	@mkcert -install
	@mkcert -cert-file=config/certs/local.cert -key-file=config/certs/local.key $(CERT_DOMAINS)

start:
	docker-compose up --force-recreate

stop:
	docker-compose down -v

uninstall:
	@rm -rf ./.docker ./logs ./config/certs
	@docker-compose rm --force --volumes
