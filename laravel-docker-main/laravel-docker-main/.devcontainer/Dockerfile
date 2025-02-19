# Use the official Laravel image as a parent image
FROM laravelsail/php80-composer

# Install system dependencies
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql

# Set the working directory
WORKDIR /workspace

# Copy the current directory contents into the container at /workspace
COPY . /workspace

# Install Composer dependencies
RUN composer install

# Expose port 8000
EXPOSE 8000