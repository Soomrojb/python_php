import requests
import json
from bs4 import BeautifulSoup
import os
import sys

def getHtml(fetch):
	data = requests.get(fetch, verify=False)
	html = data.text
	return html

def getSoup(html):
	soup = BeautifulSoup(html, "html.parser")
	return soup

def makeSoup(url):
	html = getHtml(url)
	soup = getSoup(html)
	return soup