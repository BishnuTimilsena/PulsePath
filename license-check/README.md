
## Getting Started

Follow these steps to set up and run the project locally.

### Prerequisites

- Python 3.6 or higher

### Setting Up a Virtual Environment

1. Create a Python virtual environment:

    ```bash
    python -m venv venv
    ```

2. Activate the virtual environment:

    - On Windows:

        ```bash
        .\venv\Scripts\activate
        ```

    - On Unix or MacOS:

        ```bash
        source venv/bin/activate
        ```

### Installing Dependencies

Install project dependencies using the provided `requirements.txt` file. If you need to generate the `requirements.txt` file, you can use pipreqs:

    pip install pipreqs
    pipreqs /path/to/your/project

### Installing Dependencies
    pip install -r requirements.txt

### Running the Application
```bash
python main.py
```
### Making a Request
Make a POST request to localhost:5000/verify-license with the following request body:

 ```bash
    {
    "dob": "2020-01-03",
    "license_number": "01-02-01010101"
}
        ```
### Expected Response
Upon successful verification, the response should be:

{
  "message": "Successfully verified"
}

'''
