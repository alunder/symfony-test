## Setup Test Environment

To start the Docker image you can use the following commands:

- To Start Docker and bring up environment:

`docker-compose up -d`

- To then install symfony:

`docker-compose exec php composer install`

- View site at: http://local.symfonytest.com:92/ (you will need to change your hosts file)

## The Test

Create a page that has a form with an input to put in a UK Postcode. Upon submitting this check to see if the postcode 
is within the M25 area, in the `data` folder you will find a list of the start of postcodes within the M25 to use.

If the postcode is within the M25 then please on the page display `SUCCESS - Postcode Within M25`, if not then display
`ERROR - Postcode Outside M25`

Please put all logic for this in a class in the `Service` folder and create a Controller that uses the URL `/postcode`

Examples of postcodes within and outside the M25 are as follows, you can't rely on having a space between the two parts:

Bonus marks if you can also identify if an invalid Postcode has been entered

#### Within

- SW11 2RD
- W1B2QD
- E17 4RD
- NW1 2AR

#### Outside

- M22 5EJ
- G2 4ER
- RG47DT