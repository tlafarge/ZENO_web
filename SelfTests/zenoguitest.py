
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.common.exceptions import NoSuchElementException
from selenium.webdriver.support.ui import Select

from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.common.exceptions import TimeoutException

import datetime
import os
import zenoguitest
def zenoGuiTest(
        urlTest = "",
        nbTest = "",
        boldfile_in = "",
        extWalkType_in = 1, #Radio button choice 1 2 3 or 4
        nbWalk_in = "",
        sdCap_in = "",
        minNbWalkCap_in = "",
        sdPol_in = "",
        minNbWalkPol_in= "",

        intWalkType_in = 1, #Radio button choice 1 2 or 3
        nbSamples_in = "",
        sdVol_in = "",
        minNbSample_in = "",

        hunits_in = "",
        temp_in = "",
        mass_in = "",
        viscosity_in = "",
        buoyancy_in = "",

        hunitsType_in = "", # L,m,cm,nm,A
        temperatureType_in = "", #C,K
        massType_in = "", #Da,kDa,g,kg
        viscosityType_in = "", # cp,P


        seed_in = "27",
        rlaunch_in = "",
        skinT_in = "",
        hitPoints_in = False,
        ram_in = False,
        surfacePoints_in = False,
        interiorPoints_in = False,
        driver = ""
):
    driver.get(urlTest)
    success = False
    file_object  = open(boldfile_in, "r")
    bod_text = file_object.read()
    bod_text = bod_text.replace("\r\n","\n")
    bod_array = bod_text.split("\n")

    for temp in bod_array:
        driver.find_element_by_id("output1").send_keys(temp)
        driver.find_element_by_id("output1").send_keys(Keys.RETURN)

    if(extWalkType_in == 1):
        driver.find_element_by_xpath("(//input[@name='extRad'])[1]").click()
        driver.find_element_by_id("nbWalk").clear()
        driver.find_element_by_id("nbWalk").send_keys(nbWalk_in)


    if(extWalkType_in == 2):
        driver.find_element_by_xpath("(//input[@name='extRad'])[2]").click()
        driver.find_element_by_id("sdCap").clear()
        driver.find_element_by_id("sdCap").send_keys(sdCap_in)
        driver.find_element_by_id("minNbWalkCap").clear()
        driver.find_element_by_id("minNbWalkCap").send_keys(minNbWalkCap_in)

    if(extWalkType_in == 3):
        driver.find_element_by_xpath("(//input[@name='extRad'])[3]").click()
        driver.find_element_by_id("sdPol").clear()
        driver.find_element_by_id("sdPol").send_keys(sdPol_in)
        driver.find_element_by_id("minNbWalkPol").clear()
        driver.find_element_by_id("minNbWalkPol").send_keys(minNbWalkPol_in)

    if(extWalkType_in == 4):
        driver.find_element_by_xpath("(//input[@name='extRad'])[4]").click()

    if(intWalkType_in == 1):
        driver.find_element_by_xpath("(//input[@name='intRad'])[1]").click()
        driver.find_element_by_id("nbSamples").clear()
        driver.find_element_by_id("nbSamples").send_keys(nbSamples_in)

    if(intWalkType_in == 2):
        driver.find_element_by_xpath("(//input[@name='intRad'])[2]").click()
        driver.find_element_by_id("sdVol").clear()
        driver.find_element_by_id("sdVol").send_keys(sdVol_in)
        driver.find_element_by_id("minNbSample").clear()
        driver.find_element_by_id("minNbSample").send_keys(minNbSample_in)

    if(intWalkType_in == 3):
        driver.find_element_by_xpath("(//input[@name='intRad'])[3]").click()

    driver.find_element_by_id("arrowDiv").click()
    driver.find_element_by_id("hunits").clear()
    driver.find_element_by_id("hunits").send_keys(hunits_in)
    driver.find_element_by_id("temp").clear()
    driver.find_element_by_id("temp").send_keys(temp_in)
    driver.find_element_by_id("mass").clear()
    driver.find_element_by_id("mass").send_keys(mass_in)
    driver.find_element_by_id("viscosity").clear()
    driver.find_element_by_id("viscosity").send_keys(viscosity_in)
    driver.find_element_by_id("buoyancy").clear()
    driver.find_element_by_id("buoyancy").send_keys(buoyancy_in)

    if (hunitsType_in !=""):
        driver.find_element_by_xpath("//option[@value='"+hunitsType_in+"']").click()

    if (temperatureType_in !=""):
        driver.find_element_by_xpath("//option[@value='"+temperatureType_in+"']").click()

    if (massType_in !=""):
        driver.find_element_by_xpath("//option[@value='"+massType_in+"']").click()

    if (viscosityType_in !=""):
        driver.find_element_by_xpath("//option[@value='"+viscosityType_in+"']").click()

    driver.find_element_by_id("arrowDiv2").click()
    driver.find_element_by_id("seed").clear()
    driver.find_element_by_id("seed").send_keys(seed_in)
    driver.find_element_by_id("rlaunch").clear()
    driver.find_element_by_id("rlaunch").send_keys(rlaunch_in)
    driver.find_element_by_id("skinT").clear()
    driver.find_element_by_id("skinT").send_keys(skinT_in)

    if(hitPoints_in):
        driver.find_element_by_id("hitPoints").click()

    if(ram_in):
        driver.find_element_by_id("ram").click()

    if(surfacePoints_in):
        driver.find_element_by_id("surfacePoints").click()

    if(interiorPoints_in):
        driver.find_element_by_id("interiorPoints").click()

    driver.find_element_by_xpath("//input[@value='Run the computation']").click()


    delay = 5 # seconds max second for test
    pageLoaded = False;
    try:
        print ("Test " + nbTest + " result page loaded")
        pageLoaded = WebDriverWait(driver, delay).until(EC.presence_of_element_located((By.LINK_TEXT, "Download results file")))
    except TimeoutException:
        print ("Test " + nbTest + "Failed!")

    if (pageLoaded!=False):
        os.system("curl " +"-so outputs/results"+nbTest+".txt "+driver.find_element_by_link_text("Download results file").get_attribute("href"))
        os.system("curl " +"-so outputs/input"+nbTest+".bod "+driver.find_element_by_link_text("Download bod file").get_attribute("href"))

        os.system("sed '/.*RAM.*/d;/.*(s).*/d;/.*time.*/d;/.*Input file.*/d' ./outputs/results"+nbTest+".txt > ./outputs/smallresultsOut"+nbTest+".txt")
        os.system("sed '/.*RAM.*/d;/.*(s).*/d;/.*time.*/d;/.*Input file.*/d' ./expected/results"+nbTest+".txt > ./outputs/smallresultsIn"+nbTest+".txt")

        diffValue = os.system("diff ./outputs/smallresultsIn"+nbTest+".txt ./outputs/smallresultsOut"+nbTest+".txt")
        if(diffValue==0):
            print("Test " + nbTest + " identical txt result files excluding RAM and time")
            success = True
        else:
            print("Test " + nbTest + " different txt result files excluding RAM and time")
            os.system("diff ./outputs/smallresultsIn"+nbTest+".txt ./outputs/smallresultsOut"+nbTest+".txt")

        diffValue = os.system("diff ./expected/input"+nbTest+".bod ./outputs/input"+nbTest+".bod")
        if(diffValue==0):
            print("Test " + nbTest + " The bod files are the identical")
        else:
            print("Test " + nbTest + " The bod files are different")
            success = False
            os.system("diff ./expected/input"+nbTest+".bod ./outputs/input"+nbTest+".bod")

    return success;
