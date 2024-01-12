create python virtual env and activate
    https://docs.python.org/3/tutorial/venv.html

install requirements from requirements.txt, use pipreqs to generate requirements if necessary

run main.py 

Request format
 POST localhost:5000/verify-license
 body:{
    "dob": "2020-01-03",
    "license_number": "01-02-01010101"
}

Response format
{
    message:"successfully verified"
}