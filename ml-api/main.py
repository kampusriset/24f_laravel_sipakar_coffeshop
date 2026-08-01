from fastapi import FastAPI, HTTPException
from pydantic import BaseModel, Field
import joblib
import pandas as pd
import os

# --- Konfigurasi path model ---
MODEL_DIR = os.path.join(os.path.dirname(__file__), "models")
MODEL_PATH = os.path.join(MODEL_DIR, "model_dt.pkl")
OHE_PATH = os.path.join(MODEL_DIR, "one_hot_enc.pkl")
LABEL_ENCODER_PATH = os.path.join(MODEL_DIR, "label_enc.pkl")

# --- Load model sekali saja saat server start ---
model = joblib.load(MODEL_PATH)
encoder = joblib.load(OHE_PATH)
label_encoder = joblib.load(LABEL_ENCODER_PATH)

# Kolom kategorikal yang di-OHE
CATEGORICAL_COLS = ["Menu", "Promo", "Hari"]

# Ambil daftar valid kategori langsung dari encoder
VALID_MENU = list(encoder.categories_[0])
VALID_PROMO = list(encoder.categories_[1])
VALID_HARI = list(encoder.categories_[2])

app = FastAPI(title="Coffee Shop Stock Prediction API")


class PredictionInput(BaseModel):
    menu: str = Field(..., description="Nama menu, contoh: 'Cold Brew'")
    promo: str = Field(..., description="'Ya' atau 'Tidak'")
    hari: str = Field(..., description="Nama hari, contoh: 'Saturday'")
    bulan: int = Field(..., ge=1, le=12, description="Angka bulan 1-12")


class PredictionOutput(BaseModel):
    menu: str
    prediksi: str


@app.get("/")
def root():
    return {"status": "ok", "message": "Coffee Shop Stock Prediction API is running"}


@app.get("/valid-options")
def valid_options():
    """Endpoint bantu supaya Laravel bisa ambil daftar pilihan valid untuk dropdown form."""
    return {
        "menu": VALID_MENU,
        "promo": VALID_PROMO,
        "hari": VALID_HARI,
    }


@app.post("/predict", response_model=PredictionOutput)
def predict(payload: PredictionInput):
    # --- Validasi input ---
    if payload.menu not in VALID_MENU:
        raise HTTPException(status_code=400, detail=f"Menu '{payload.menu}' tidak dikenali. Pilihan valid: {VALID_MENU}")
    if payload.promo not in VALID_PROMO:
        raise HTTPException(status_code=400, detail=f"Promo '{payload.promo}' tidak dikenali. Pilihan valid: {VALID_PROMO}")
    if payload.hari not in VALID_HARI:
        raise HTTPException(status_code=400, detail=f"Hari '{payload.hari}' tidak dikenali. Pilihan valid: {VALID_HARI}")

    # --- Susun dataframe sesuai struktur training ---
    raw_data = pd.DataFrame({
        "Menu": [payload.menu],
        "Promo": [payload.promo],
        "Hari": [payload.hari],
        "Bulan": [payload.bulan],
    })

    raw_text = raw_data[CATEGORICAL_COLS]
    raw_numb = raw_data.drop(columns=CATEGORICAL_COLS)

    # --- One-hot encoding ---
    encoded = encoder.transform(raw_text)
    encoded_df = pd.DataFrame(
        encoded,
        columns=encoder.get_feature_names_out(CATEGORICAL_COLS)
    )

    input_pred = pd.concat([raw_numb, encoded_df], axis=1)

    # --- Pastikan urutan kolom sama persis dengan saat training ---
    input_pred = input_pred[model.feature_names_in_]

    # --- Prediksi ---
    pred_encoded = model.predict(input_pred)
    pred_label = label_encoder.inverse_transform(pred_encoded)

    return PredictionOutput(menu=payload.menu, prediksi=str(pred_label[0]))
