#from rembg import remove
#from PIL import Image

#input_path = 'F:\\Projects\\Coding\\fashionborne\\cropped_images'
#output_path = 'F:\\Projects\\Coding\\fashionborne\\cropped_images\\done'

#input = Image.open(input_path)
#output = remove(input)
#output.save(output_path)
import os
from rembg import remove
from PIL import Image

input_path = 'F:\\Projects\\Coding\\fashionborne\\cropped_images'
output_path = 'F:\\Projects\\Coding\\fashionborne\\cropped_images\\done'

# Create the output directory if it doesn't exist
if not os.path.exists(output_path):
    os.makedirs(output_path)

# Iterate through all files in the input directory
for file_name in os.listdir(input_path):
    if file_name.endswith('.png'):
        input_file_path = os.path.join(input_path, file_name)
        output_file_path = os.path.join(output_path, file_name)
        
        # Open the input image
        input_image = Image.open(input_file_path)
        
        # Remove the background
        output_image = remove(input_image)
        
        # Save the output image
        output_image.save(output_file_path)

print("Background removal complete for all images.")
