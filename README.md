# NearestStationsFinder
With this PHP script you can find the nearest station using a GET parameter with coordinates (lat/lon).
Call the script with this as example: www.yoursite.com/index.php?lat=52.1712883&lon=5.0929191.
Or use your own coordinates.

The output is in JSON. You are responsible for a beautiful publication yourself. maybe... i make a sample-file over time.

You'll need to have an account for the NS-API. You can create an account here, and then you can 
generate a key: https://apiportal.ns.nl/. 

First rename config.inc.php.sample to config.inc.php, and then put the key on the right place.


ToDo: 

- Option to use GoTrain instead of NS API.
- Use caching for a couple of minutes. We know that a train can always be delayed suddenly. So this is at your own risk. It does make the travel information less accurate, but if you call the script often, it saves a lot of API requests. A low value of a few minutes should be acceptable.
- A simple sample...
- An authorisation check for the NS API