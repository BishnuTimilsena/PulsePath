from flask import Flask, jsonify
from fetchLicenseData import fetchLicenseData
from verifyLicense import verify_license

app = Flask(__name__)

@app.route('/verify-license', methods=['POST'])
def main():
    licenseData = fetchLicenseData()
    return jsonify(verify_license(licenseData=licenseData))
    
if __name__ == '__main__':
    app.run()