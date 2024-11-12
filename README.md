*** To run on Google Cloud

Tech note: https://cloud.google.com/build/docs/build-push-docker-image?hl=es-419

Compila y envía una imagen de Docker con Cloud Build
https://cloud.google.com/build/docs/build-push-docker-image?hl=es-419#prepare_source_files_to_build
https://cloud.google.com/build/docs/build-push-docker-image?hl=es-419#create_a_docker_repository_in
https://cloud.google.com/build/docs/build-push-docker-image?hl=es-419#build_an_image_using_dockerfile

*** To run on AWS
Follow the wizard of: Amazon Elastic Container Registry
Deploy it on: AWS App Runner

**** To run local machine

Build image: docker build -t expenses .
Run image: docker run -d -p 8000:8000 expenses



***** TO BUILD ****
+++To build for AWS+++

docker build -t nrebequi/expenses . 
docker tag nrebequi/expenses:latest public.ecr.aws/l6s6k0c7/nrebequi/expenses:latest
docker push public.ecr.aws/l6s6k0c7/nrebequi/expenses:latest   ***You need the aws cli to do this

** and logged in:
aws ecr-public get-login-password --region us-east-1 | docker login --username AWS --password-stdin public.ecr.aws/l6s6k0c7

# Build the image
docker build -t your-app-name .

# Tag for ECR
docker tag your-app-name public.ecr.aws/l6s6k0c7/nrebequi/expenses:latest

# Push to ECR
docker push public.ecr.aws/l6s6k0c7/nrebequi/expenses:latest