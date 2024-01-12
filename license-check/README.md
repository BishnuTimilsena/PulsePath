create python virtual env and activate
    https://docs.python.org/3/tutorial/venv.html

install requirements from requirements.txt, use pipreqs to generate requirements if necessary

run main.py 

Request format
 POST localhost:5000/verify-license
 body:{
    "dob":"YYYY-MM-DD",
    "license-check":"XX-XX-XXXXXXXX"
 }

Response format
{
    message:"successfully verified"
}