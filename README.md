# F1 Widgets

A Laravel-based Formula 1 web application focused on displaying race-related information through a set of small, modular widgets and pages.

## Overview

This project was built as a personal Laravel learning project with a focus on application structure, service-based architecture, and working with external APIs.

The app integrates Formula 1 data and presents it through dedicated pages such as a race calendar, race control messages, and race-themed recipe suggestions. A key goal of the project was to keep controllers lightweight by moving external API and data-handling logic into dedicated service classes.

## Current Features

- **Race calendar page** for viewing race information
- **Race control page** for displaying race control messages
- **Latest race control messages API endpoint**
- **Recipe suggestion page** tied to race context
- Blade-based frontend rendering
- Service classes for external API access and supporting data lookup

## Project Structure

The project is organised around a fairly typical Laravel MVC structure, with additional service classes to keep business logic out of controllers.

### Routes
The application currently exposes routes for:

- `/` – welcome page
- `/calendar` – latest race/calendar view
- `/recipe-suggestions` – race-based recipe suggestions
- `/race-control` – race control messages page
- `/api/race-control/latestMessages` – endpoint for latest race control messages
- `/style-guide` – style guide view

### Controllers
Controllers are kept intentionally small and mainly coordinate data flow between services and views.

Examples include:

- `CalendarController`
- `RaceController`
- `RecipeController`

### Services
A major focus of this project was using services to separate responsibilities cleanly.

- **`OpenF1`** handles communication with the external F1 API
- **`NationalDishService`** loads supporting dish data from local JSON storage

The `OpenF1` service also includes caching logic for data such as race control messages and session information to reduce unnecessary repeated API calls.

## Technical Focus

This project was mainly used to practise:

- Laravel application structure
- Dependency injection
- Service-layer design
- External API integration
- Caching with Laravel
- Keeping controllers thin and maintainable
- Building a server-rendered app with Blade

## Tech Stack

- PHP 8.2
- Laravel 11
- Blade
- Guzzle
- Vite
- Tailwind CSS
- Axios

## Current Status

This project is a **work in progress**.

Development lost momentum because some of the live-data functionality depended on API access that required payment to continue using the features I wanted to build around. Rather than forcing incomplete paid integrations, I left the project in its current state as a learning project that still demonstrates Laravel structure, service usage, and API integration.

## What This Project Demonstrates

Even though the project is incomplete, it still shows:

- practical Laravel project setup
- use of service classes for separation of concerns
- dependency injection in controllers
- integration with external data sources
- basic caching strategy for API-driven features
- a modular approach to adding new pages/features

## Potential Future Improvements

- Replace or extend the current API integration
- Add more complete live-race functionality
- Improve frontend interactivity
- Expand test coverage
- Refine UI styling and UX
- Add clearer setup instructions and screenshots

## Running the Project

Standard Laravel setup should apply:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan serve
npm run dev
