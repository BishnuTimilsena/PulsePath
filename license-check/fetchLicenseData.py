from flask import request
def fetchLicenseData():
    try:
      
        data = request.get_json()
        print("data:")
        print(data)
     
        dob = data.get('dob')
        license_number = data.get('license_number')

        response_data = {
            'dob': dob,
            'license_number': license_number,
        }
        return response_data
    except Exception as e:
        # Handle exceptions, if any
        error_message = {'error': str(e)}
        return error_message, 500 

