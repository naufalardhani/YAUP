import os
from time import sleep
from sys import argv

from selenium import webdriver
from selenium.webdriver.common.by import By


USERNAME = 'admin'
PASSWORD = os.getenv('FLAG_2', 'F4J{flag_2}')


def visit(target_url):
    driver = webdriver.Firefox()
    driver.get('http://127.0.0.1/login')

    print("Login as " + USERNAME + "...")
    username_field = driver.find_element(By.NAME, 'username')
    password_field = driver.find_element(By.NAME, 'password')
    submit_button = driver.find_element(By.ID, 'submitButton')

    username_field.send_keys(USERNAME)
    password_field.send_keys(PASSWORD)
    submit_button.click()
    sleep(1)

    print("Visiting " + target_url + "...")
    driver.get(target_url)

    sleep(3)
    driver.quit()


if __name__ == '__main__':
    if len(argv) == 2:
        visit(argv[1])
    else:
        print('Usage: python3 visit.py <target_url>')
