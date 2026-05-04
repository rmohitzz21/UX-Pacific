import glob
import os

pattern = r'C:\xampp\htdocs\UX_Pacific\ui-ux-design-agency-in-*.php'
files = glob.glob(pattern)

for filepath in files:
    try:
        with open(filepath, 'w') as f:
            f.write('')
        print(f"Emptied: {os.path.basename(filepath)}")
    except Exception as e:
        print(f"Error with {filepath}: {e}")

print(f"\nTotal files emptied: {len(files)}")
