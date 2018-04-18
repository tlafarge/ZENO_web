
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
import unittest
import zenoguitest


class TestZenoGui(unittest.TestCase):

    @classmethod
    def setUpClass(self):
        self.driver = webdriver.Firefox()
        self.urlTest ="http://stat.nist.gov/consensus/zeno/"


    def test_1(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "1",
                boldfile_in = "./inputs/sphere.bod",
                extWalkType_in = 1 ,
                nbWalk_in = "200000",
                sdCap_in = "",
                minNbWalkCap_in = "",
                sdPol_in = "",
                minNbWalkPol_in= "",

                intWalkType_in = 1 ,
                nbSamples_in = "200000",
                sdVol_in = "",
                minNbSample_in = "",

                hunits_in = "3",
                temp_in = "20",
                mass_in = "140",
                viscosity_in = "10",
                buoyancy_in = "5",

                hunitsType_in = "nm" ,
                temperatureType_in = "C",
                massType_in = "Da",
                viscosityType_in = "cp" ,

                seed_in = "27",
                rlaunch_in = "",
                skinT_in = "",
                hitPoints_in = True,
                ram_in = True,
                surfacePoints_in = True,
                interiorPoints_in = True,
                driver = self.driver
        ))

    def test_2(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "2",
                boldfile_in = "./inputs/sphere.bod",
                extWalkType_in = 2, #Radio button choice 1 2 3 or 4
                nbWalk_in = "",
                sdCap_in = "0.2",
                minNbWalkCap_in = "4000",
                sdPol_in = "",
                minNbWalkPol_in= "",

                intWalkType_in = 2, #Radio button choice 1 2 or 3
                nbSamples_in = "",
                sdVol_in = "0.2",
                minNbSample_in = "4000",

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
                rlaunch_in = "2",
                skinT_in = "0.004",
                hitPoints_in = False,
                ram_in = False,
                surfacePoints_in = False,
                interiorPoints_in = False,
                driver = self.driver
        ))

    def test_3(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "3",
                boldfile_in = "./inputs/sphere.bod",
                extWalkType_in = 3, #Radio button choice 1 2 3 or 4
                nbWalk_in = "",
                sdCap_in = "",
                minNbWalkCap_in = "",
                sdPol_in = "0.2",
                minNbWalkPol_in= "3000",

                intWalkType_in = 3, #Radio button choice 1 2 or 3
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
                driver = self.driver
        ))

    def test_4(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "4",
                boldfile_in = "./inputs/sphere.bod",
                extWalkType_in = 1, #Radio button choice 1 2 3 or 4
                nbWalk_in = "2000",
                sdCap_in = "",
                minNbWalkCap_in = "",
                sdPol_in = "",
                minNbWalkPol_in= "",

                intWalkType_in = 1, #Radio button choice 1 2 or 3
                nbSamples_in = "2000",
                sdVol_in = "",
                minNbSample_in = "",

                hunits_in = "45",
                temp_in = "25",
                mass_in = "1",
                viscosity_in = "0.2",
                buoyancy_in = "",

                hunitsType_in = "A", # L,m,cm,nm,A
                temperatureType_in = "C", #C,K
                massType_in = "kDa", #Da,kDa,g,kg
                viscosityType_in = "p", # cp,p

                seed_in = "27",
                rlaunch_in = "",
                skinT_in = "",
                hitPoints_in = False,
                ram_in = False,
                surfacePoints_in = False,
                interiorPoints_in = False,
                driver = self.driver
        ))
    def test_5(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "5",
                boldfile_in = "./inputs/sphere.bod",
                extWalkType_in = 1, #Radio button choice 1 2 3 or 4
                nbWalk_in = "2000",
                sdCap_in = "",
                minNbWalkCap_in = "",
                sdPol_in = "",
                minNbWalkPol_in= "",

                intWalkType_in = 1, #Radio button choice 1 2 or 3
                nbSamples_in = "2000",
                sdVol_in = "",
                minNbSample_in = "",

                hunits_in = "123",
                temp_in = "",
                mass_in = "",
                viscosity_in = "",
                buoyancy_in = "",

                hunitsType_in = "", # L,m,cm,nm,A
                temperatureType_in = "", #C,K
                massType_in = "", #Da,kDa,g,kg
                viscosityType_in = "", # cp,p

                seed_in = "27",
                rlaunch_in = "",
                skinT_in = "",
                hitPoints_in = False,
                ram_in = False,
                surfacePoints_in = False,
                interiorPoints_in = False,
                driver = self.driver
        ))

    def test_6(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "6",
                boldfile_in = "./inputs/test6.bod",
                extWalkType_in = 1, #Radio button choice 1 2 3 or 4
                nbWalk_in = "2000",
                sdCap_in = "",
                minNbWalkCap_in = "",
                sdPol_in = "",
                minNbWalkPol_in= "",

                intWalkType_in = 1, #Radio button choice 1 2 or 3
                nbSamples_in = "2000",
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
                viscosityType_in = "", # cp,p

                seed_in = "27",
                rlaunch_in = "",
                skinT_in = "",
                hitPoints_in = False,
                ram_in = False,
                surfacePoints_in = False,
                interiorPoints_in = False,
                driver = self.driver
        ))

    def test_7(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "7",
                boldfile_in = "./inputs/sphere.bod",
                extWalkType_in = 1, #Radio button choice 1 2 3 or 4
                nbWalk_in = "2000",
                sdCap_in = "",
                minNbWalkCap_in = "",
                sdPol_in = "",
                minNbWalkPol_in= "",

                intWalkType_in = 1, #Radio button choice 1 2 or 3
                nbSamples_in = "2000",
                sdVol_in = "",
                minNbSample_in = "",

                hunits_in = "3",
                temp_in = "290",
                mass_in = "3",
                viscosity_in = "",
                buoyancy_in = "",

                hunitsType_in = "cm", # L,m,cm,nm,A
                temperatureType_in = "K", #C,K
                massType_in = "g", #Da,kDa,g,kg
                viscosityType_in = "p", # cp,p

                seed_in = "27",
                rlaunch_in = "",
                skinT_in = "",
                hitPoints_in = False,
                ram_in = False,
                surfacePoints_in = False,
                interiorPoints_in = False,
                driver = self.driver
        ))

    def test_8(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "8",
                boldfile_in = "./inputs/test8.bod",
                extWalkType_in = 1, #Radio button choice 1 2 3 or 4
                nbWalk_in = "100000",
                sdCap_in = "",
                minNbWalkCap_in = "",
                sdPol_in = "",
                minNbWalkPol_in= "",

                intWalkType_in = 1, #Radio button choice 1 2 or 3
                nbSamples_in = "100000",
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
                viscosityType_in = "", # cp,p

                seed_in = "27",
                rlaunch_in = "",
                skinT_in = "",
                hitPoints_in = False,
                ram_in = False,
                surfacePoints_in = False,
                interiorPoints_in = False,
                driver = self.driver
        ))

    def test_9(self):
        self.assertTrue(zenoguitest.zenoGuiTest(
                urlTest = self.urlTest,
                nbTest = "9",
                boldfile_in = "./inputs/test9.bod",
                extWalkType_in = 1, #Radio button choice 1 2 3 or 4
                nbWalk_in = "100000",
                sdCap_in = "",
                minNbWalkCap_in = "",
                sdPol_in = "",
                minNbWalkPol_in= "",

                intWalkType_in = 1, #Radio button choice 1 2 or 3
                nbSamples_in = "100000",
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
                viscosityType_in = "", # cp,p

                seed_in = "27",
                rlaunch_in = "",
                skinT_in = "",
                hitPoints_in = False,
                ram_in = False,
                surfacePoints_in = False,
                interiorPoints_in = False,
                driver = self.driver
        ))

    @classmethod
    def tearDownClass(self):
        raw_input("Press Enter to continue, close browser and delete temp files...")
        self.driver.quit()
        map( os.unlink, (os.path.join( "./outputs",f) for f in os.listdir("./outputs")) )
        print("Output files Removed!")




if __name__ == '__main__':
  suite = unittest.TestLoader().loadTestsFromTestCase(TestZenoGui)
  unittest.TextTestRunner(verbosity=2).run(suite)
