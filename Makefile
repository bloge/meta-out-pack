build: clear
	mkdir build
	vendor/bloge/bloge/bin/bloge app.php build

clear:
	rm -rf build