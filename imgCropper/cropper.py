from PIL import Image
import os

input_path = "C:\\Users\\arttu\\Documents\\SteamPics"
output_path = "F:\\Projects\\Coding\\fashionborne\\cropped_images"  # Change this to your desired output path

# Create the output directory if it doesn't exist
os.makedirs(output_path, exist_ok=True)

def crop_and_save(input_file_path):
    im = Image.open(input_file_path)
    filename, file_extension = os.path.splitext(os.path.basename(input_file_path))
    output_file_path = os.path.join(output_path, f"{filename}.png")
    im_crop = im.crop((685, 363, 1258, 1180))
    im_crop.save(output_file_path, "PNG", quality=100)

def crop_all_images(input_folder):
    for item in os.listdir(input_folder):
        fullpath = os.path.join(input_folder, item)
        if os.path.isfile(fullpath):
            crop_and_save(fullpath)

crop_all_images(input_path)