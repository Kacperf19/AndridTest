
const SETTINGS_KEY = "page_settings";


function applySettings(settings) {
  if (settings.bgColor) document.body.style.backgroundColor = settings.bgColor;
  if (settings.textColor) document.body.style.color = settings.textColor;
  if (settings.fontSize) document.body.style.fontSize = settings.fontSize + "px";
  if (settings.fontFamily) document.body.style.fontFamily = settings.fontFamily;
}


function loadSettings() {
  const settings = localStorage.getItem(SETTINGS_KEY);
  return settings ? JSON.parse(settings) : null;
}


function saveSettings(settings) {
  localStorage.setItem(SETTINGS_KEY, JSON.stringify(settings));
}


function resetSettings() {
  localStorage.removeItem(SETTINGS_KEY);
  location.reload();
}


document.addEventListener("DOMContentLoaded", () => {
  const bgColorInput = document.getElementById("bg-color");
  const textColorInput = document.getElementById("text-color");
  const fontSizeInput = document.getElementById("font-size");
  const fontFamilySelect = document.getElementById("font-family");
  const resetButton = document.getElementById("reset-btn");


  const currentSettings = loadSettings() || {
    bgColor: "#ffffff",
    textColor: "#000000",
    fontSize: 16,
    fontFamily: "Arial, sans-serif",
  };
  applySettings(currentSettings);

  if (bgColorInput) bgColorInput.value = currentSettings.bgColor;
  if (textColorInput) textColorInput.value = currentSettings.textColor;
  if (fontSizeInput) fontSizeInput.value = currentSettings.fontSize;
  if (fontFamilySelect) fontFamilySelect.value = currentSettings.fontFamily;

  const updateSettings = () => {
    const newSettings = {
      bgColor: bgColorInput.value,
      textColor: textColorInput.value,
      fontSize: fontSizeInput.value,
      fontFamily: fontFamilySelect.value,
    };
    saveSettings(newSettings);
    applySettings(newSettings);
  };

  if (bgColorInput) bgColorInput.addEventListener("input", updateSettings);
  if (textColorInput) textColorInput.addEventListener("input", updateSettings);
  if (fontSizeInput) fontSizeInput.addEventListener("input", updateSettings);
  if (fontFamilySelect) fontFamilySelect.addEventListener("change", updateSettings);
  if (resetButton) resetButton.addEventListener("click", resetSettings);
});
