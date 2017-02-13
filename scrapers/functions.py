from bs4 import BeautifulSoup
import requests
import json
import urllib

def getHtml(fetch):
	#data = requests.get(fetch, verify=False)
	#html = data.text
	data = urllib.urlopen(fetch)
	html = data.read()
	return html

def getSoup(html):
	soup = BeautifulSoup(html, "lxml")
	return soup

def makeSoup(url):
	html = getHtml(url)
	soup = getSoup(html)
	return soup