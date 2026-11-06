# instaphoto

Minimalist self-hosted photo sharing web app built with PHP, GD, and EXIF metadata parsing.

## Features

- **Automatic Square Cropping & Resizing**: Uploaded photos (`upload.php`) are center-cropped to a 1:1 square and resampled to `640×640` JPEG using PHP's GD library (`imagecopyresampled`).
- **EXIF Orientation & Timestamp Extraction**: Reads camera EXIF data (`exif_read_data`) to auto-rotate images (`Orientation` `3`, `6`, `8`) and names each file `<unix_timestamp>.jpeg` from `DateTimeOriginal` (falling back to upload time).
- **Reverse-Chronological Feed**: Scans `./uploads`, sorts photos newest-first, and renders 10 photos per page (`index.php?p=1`) with day, date, and time metadata.
- **Simple Cookie Authentication**: Authenticates via MD5 password hash (`set.php?key=<password>`) to enable photo uploads and one-click deletion (`delete.php?id=`).

## Setup

1. Make the `uploads/` directory writable by PHP:
   ```bash
   chmod 777 ./uploads
   ```
2. Generate an MD5 hash of your password and set `$password` in `include/context.php`.
3. Ensure PHP has the `gd` and `exif` extensions enabled.
4. Log in by visiting `/set.php?key=<your-password>`.