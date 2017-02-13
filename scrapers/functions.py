from bs4 import BeautifulSoup
import requests
import json

def getHtml(fetch):
	data = requests.get(fetch, verify=False)
	html = data.text
	return html

def getSoup(html):
	soup = BeautifulSoup(html, "lxml")
	return soup

def makeSoup(url):
	html = getHtml(url)
	soup = getSoup(html)
	return soup