import sys
import json
import joblib

# Load the saved model and encoders
try:
    model = joblib.load('career_model.pkl')

    # Load label encoders for each feature
    label_encoders = {}
    features = ['interests_excitement', 'working_style', 'enjoy_risk', 
                'skills_description', 'managing_people', 
                'five_years_vision', 'excites_most', 
                'financial_stability', 'education_loan', 'loan_amount']

    for feature in features:
        label_encoders[feature] = joblib.load(f'{feature}_encoder.pkl')

    # Load target encoder
    target_encoder = joblib.load('target_encoder.pkl')

except FileNotFoundError as e:
    print(f"Error loading model or encoder files: {str(e)}")
    sys.exit()

# Get input file name from command-line argument (from PHP)
if len(sys.argv) > 1:
    input_file = sys.argv[1]

    # Read the JSON data from the file
    try:
        with open(input_file, 'r') as file:
            data = json.load(file)
    except Exception as e:
        print(f"Error reading input file: {str(e)}")
        sys.exit()
else:
    print("No input file provided!")
    sys.exit()

# Preprocess the input data
input_data = []
for feature in features:
    if feature in data:
        input_data.append(label_encoders[feature].transform([data[feature]])[0])
    else:
        print(f"Missing input data for feature: {feature}")
        sys.exit()

# Perform prediction
prediction = model.predict([input_data])

# Decode the predicted label
predicted_career = target_encoder.inverse_transform(prediction)

print(f"Prediction: {predicted_career[0]}")
