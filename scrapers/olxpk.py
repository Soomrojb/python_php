from unidecode import unidecode
import functions
import json
import re

def fetchData(url, depth):
	FinalArr = []
	for pgLoop in range(1,int(depth)+1):
		pgnatdUrl = url + "?page=" + str(pgLoop)
		Soup = functions.makeSoup(pgnatdUrl)
		for mainDiv in Soup.find("table", attrs={"id": "offers_table"}).findAll("h3"):
			Title = mainDiv.find("a").find("span").text
			tdParent = mainDiv.parent
			CatANDLoc = unidecode(tdParent.find("small", attrs={"class","breadcrumb small"}).text)
			Category = CatANDLoc.split("\n")[1]
			Location = CatANDLoc.split("\n")[2]
			trParent = tdParent.parent
			Price = trParent.find("td", attrs={"class" : re.compile(r'td-price')}).find("strong").text
			
			NewList = {
			"Title" : Title,
			"Category" : Category.strip(),
			"Location" : Location,
			"Price" : Price.strip(),
			}
			
			FinalArr.append(NewList)

	return json.dumps(FinalArr)

