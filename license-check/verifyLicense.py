from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import Select
from webdriver_manager.chrome import ChromeDriverManager
from selenium.common.exceptions import NoSuchElementException
import time

def verify_license(licenseData):
    try:
        chrome_options = Options()
        # chrome_options.add_argument('--headless')  # Run in headless mode (no GUI)
        driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()),options=chrome_options)
      
        # URL to be opened
        url = 'https://applydl.dotm.gov.np/license-check'

        # Open the URL
        driver.get(url)
        print(licenseData)
        #check license
        driver.find_element(By.XPATH,"/html/body/div/div/div/div[2]/div/div/div/div[1]/form/div/div[1]/div[2]/div/input").send_keys(licenseData['license_number'])
        driver.find_element(By.ID,"dob_bs").click()
        # logic to select the correct year month and day
        year,month,day = licenseData['dob'].split('-')
        year = (int(year))
        month = (int(month))
        day = (int(day))

        year_select = Select(driver.find_element(By.ID,'year'))
        year_select.select_by_value(str(year))

        month_select = Select(driver.find_element(By.ID,'month'))
        month_select.select_by_value(str(month))

        # Click the day element based on the provided day
        day_element = driver.find_element(By.XPATH,f'//td[@data-value="{year}-{month:02d}-{day:02d}"]')
        day_element.click()
        time.sleep(1)
        
        driver.find_element(By.XPATH,"/html/body/div/div/div/div[2]/div/div/div/div[1]/form/div/div[2]/button/span").click()
        time.sleep(1)
        try:
            error = driver.find_element(By.XPATH,'//*[@id="app"]/div/div/div[2]/div/div/div/div[1]/form/div/em').text
            print(error)
            return {
                'message': error
            }
        except NoSuchElementException as e:
            error = "Successfully verified"
            print(error)
            return {
                'message': error
            }

    except Exception as e:
        # Handle exceptions, if any
        print('Error:', e)

    finally:
        # Close the WebDriver to free up resources
        driver.quit()

if __name__ == '__main__':
    # Call the function when the script is executed directly
    verify_license()
