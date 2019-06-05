Testing requires python Selenium and the firefox driver:
Available with:
pip3 install selenium
https://github.com/mozilla/geckodriver/releases

Change the line 24 of test.py to the url of the ZENO gui you wish to try:
self.urlTest ="http://stat.nist.gov/consensus/zeno/"


run all the tests by running
python3 -W ignore -Bm unittest -v selfTest

run single test by running the following command
python3 -W ignore -Bm unittest -v selfTest.TestZenoGui.test_1
