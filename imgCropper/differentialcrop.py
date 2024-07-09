

import cv2
import numpy as np
import glob
import os

# Function to remove background parts from an input image
def remove_background(input_image_path, background_image_path, output_image_path):
    # Load input and background images
    input_image = cv2.imread(input_image_path)
    background_image = cv2.imread(background_image_path)

    # Ensure both images are the same size
    if input_image.shape != background_image.shape:
        background_image = cv2.resize(background_image, (input_image.shape[1], input_image.shape[0]))

    # Compute the absolute difference between the images
    difference = cv2.absdiff(input_image, background_image)

    # Convert difference image to grayscale
    gray_difference = cv2.cvtColor(difference, cv2.COLOR_BGR2GRAY)

    # Threshold the grayscale image to create a binary mask
    _, mask = cv2.threshold(gray_difference, 30, 255, cv2.THRESH_BINARY)

    # Invert the mask
    mask_inv = cv2.bitwise_not(mask)

    # Use the mask to remove the background parts from the input image
    result = cv2.bitwise_and(input_image, input_image, mask=mask_inv)

    # Save the result
    cv2.imwrite(output_image_path, result)

    # Display the result (optional)
    # cv2.imshow('Result', result)
    # cv2.waitKey(0)
    # cv2.destroyAllWindows()

# Function to process multiple input images with the same background image
def batch_process(input_folder, background_image_path, output_folder):
    # Create output folder if it doesn't exist
    os.makedirs(output_folder, exist_ok=True)

    # Gather all .png file paths from input folder
    input_image_paths = glob.glob(os.path.join(input_folder, '*.png'))

    # Iterate over each input image path
    for input_image_path in input_image_paths:
        # Generate output image path
        output_image_path = os.path.join(output_folder, os.path.basename(input_image_path))

        # Remove background and save the processed image
        remove_background(input_image_path, background_image_path, output_image_path)

# Example usage:
if __name__ == "__main__":
    input_folder = 'F:\\Projects\\Coding\\fashionborne\\cropped_images\\chest'  # Folder containing .png images
    background_image_path = 'F:\\Projects\\Coding\\fashionborne\\cropped_images\\nude\\nude_chest.png'
    output_folder = 'F:\\Projects\\Coding\\fashionborne\\cropped_images\\done'  # Output folder to save processed images

    # Process the batch of input images
    batch_process(input_folder, background_image_path, output_folder)
