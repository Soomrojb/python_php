import functions
import json
import re

def fetchData(url):
	FinalArr = []
	Soup = functions.makeSoup(url)
	for mainDiv in Soup.find("table", attrs={"id": "offers_table"}).findAll("h3"):
		Title = mainDiv.find("a").find("span").text
		
		NewList =	{
						"Title" : Title,
					}
		
		FinalArr.append(NewList)

	return json.dumps(FinalArr)

