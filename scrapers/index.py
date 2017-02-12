#
#	Syntax: python2.7 index.py --site WebsiteONE --url http://urlofwebsiteone.com/sublinks_ifany
#

def main():
	import optparse
	import functions
	p = optparse.OptionParser()
	p.add_option('--site')
	p.add_option('--url')
	p.add_option('--depth', default=1)
	options, arguments = p.parse_args()
	
	retData = ''

	if options.site:
		toScrap = options.site
		urlToScrap = options.url
		if toScrap == 'olxpk':
			import olxpk
			retData = olxpk.fetchData(urlToScrap, options.depth)
			
	if (retData):
		print retData

if __name__ == '__main__':
    main()