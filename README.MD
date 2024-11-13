# Expenses App

A Laravel-based expenses tracking application.

## Local Development

Build and run with Docker:
```bash
docker build -t expenses .
docker run -p 8080:8080 expenses
```

## Cloud Run Deployment

Deploy to Google Cloud Run:
```bash
gcloud builds submit \
  --region=us-west2 \
  --tag us-west2-docker.pkg.dev/PROJECT_ID/notebook-expenses/quickstart-image:tag1
```
as is:
gcloud builds submit --region=us-west2 --tag us-west2-docker.pkg.dev/ft-demo-441517/notebook-expenses/quickstart-image:tag1

## Technology Stack

- Laravel
- SQLite
- Docker
- Google Cloud Run

## Environment Setup

Copy the environment file:
```bash
cp .env.example .env
```

The application uses SQLite for database storage.
