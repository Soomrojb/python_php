import functions
import json
import re
from unidecode import unidecode


def fetchData(url, depth):
	FinalArr = []
	for pgLoop in range(1,int(depth)+1):
		pgnatdUrl = url + "?page=" + str(pgLoop)
		Soup = functions.makeSoup(pgnatdUrl)
		for mainDiv in Soup.find("table", attrs={"id": "offers_table"}).findAll("h3"):
			Title = mainDiv.find("a").find("span").text
			divParent = mainDiv.parent
			CatANDLoc = unidecode(divParent.find("small", attrs={"class","breadcrumb small"}).text)
			Category = CatANDLoc.split("\n")[1]
			Location = CatANDLoc.split("\n")[2]
			
			NewList = {
			"Title" : Title,
			"Category" : Category.strip(),
			"Location" : Location,
			}
			
			FinalArr.append(NewList)

	return json.dumps(FinalArr)

