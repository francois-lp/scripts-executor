from datetime import datetime

try:
    # file path
    current_datetime = datetime.now().strftime('%Y%m%d_%H%M%S')
    # TODO : get directories from the command line options (like the PHP script)
    file_path = 'scripts/output/python/' + current_datetime + '_generated_by_python_script.txt'
    
    # file writing
    with open(file_path, 'w') as f:
        f.write('Python script executed from PHP')

    print('Python script executed successfully !')

except Exception as error:
    print("Error : " + error)
