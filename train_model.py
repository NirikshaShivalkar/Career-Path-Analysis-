import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score
import joblib

# Load the dataset
data = pd.read_excel('career_assessment_data.xlsx')

# Feature columns (questions from the form)
features = ['interests_excitement', 'working_style', 'enjoy_risk', 
            'skills_description', 'managing_people', 
            'five_years_vision', 'excites_most', 
            'financial_stability', 'education_loan', 'loan_amount']

# Target column (career path)
target = 'career_path'

# Encode categorical features (Label Encoding or OneHotEncoding)
label_encoders = {}
for feature in features:
    label_encoders[feature] = LabelEncoder()
    data[feature] = label_encoders[feature].fit_transform(data[feature])

# Encode the target variable
target_encoder = LabelEncoder()
data[target] = target_encoder.fit_transform(data[target])

# Split dataset into training and testing sets
X = data[features]  # Features
y = data[target]    # Labels

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Train the Random Forest Classifier
model = RandomForestClassifier(n_estimators=100, random_state=42)
model.fit(X_train, y_train)

# Evaluate the model
y_pred = model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred)
print(f"Model Accuracy: {accuracy * 100:.2f}%")

# Save the trained model
joblib.dump(model, 'career_model.pkl')

# Save the encoders for future use (to encode form data the same way)
for feature, encoder in label_encoders.items():
    joblib.dump(encoder, f'{feature}_encoder.pkl')

# Save target encoder
joblib.dump(target_encoder, 'target_encoder.pkl')
