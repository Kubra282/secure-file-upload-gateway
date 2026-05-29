.PHONY: run stop clean

run:
	@echo "Lokal PHP Sunucusu Başlatılıyor..."
	php -S localhost:8000 -t src/

docker-build:
	docker build -t guvenli-dosya-paneli .

docker-run:
	docker run -d -p 8080:80 --name web-guvenlik-projesi guvenli-dosya-paneli