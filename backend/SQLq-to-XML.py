from lxml import etree
import pymysql

# Open database connection
db = pymysql.connect("localhost","root","amsterdam","YogaSchool" )

# prepare a cursor object using cursor() method
cursor = db.cursor()

# execute SQL query using execute() method.
cursor.execute("SELECT voornaam, achternaam FROM Klant")

# Fetch a single row using fetchone() method.
data = cursor.fetchone()

####################################################################
# Create the root element
page = etree.Element('results')
# Make a new document tree
doc = etree.ElementTree(page)
####################################################################

# Print date
for (voornaam, achternaam )in cursor:
    print("{} {} staat in de db".format(
    voornaam, achternaam))
    # Add the subelements
    pageElement = etree.SubElement(page, 'Country',
                                        voornaam=voornaam,
                                        achternaam=achternaam,
                                        Code='DE',
                                        Storage='Basic')
    # For multiple multiple attributes, use as shown above

# disconnect from server
db.close()










# Save to XML file
doc.write('output.xml', xml_declaration=True, encoding='utf-16')

