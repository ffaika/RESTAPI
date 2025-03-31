# Module API Backend

## Introduction

In this module, you are asked to implement the SpotiSkill API.

For this purpose, you will have access to API documentation and a database, which you must use as fixtures.

No authentication is required.
Input validation is required (required, format, etc...).

In broad terms, the tasks and functionalities to be accomplished are:

- Allow creating a new registration request through an API call.
- Allow retrieving a list of registration requests through an API call.
- Allow accepting/rejecting a registration request through an API call.
- Allow retrieving a list of songs through an API call.
- Allow adding a new song through an API call.
- Allow retrieving a song through an API call.
- Allow retrieving a list of playlists through an API call.
- Allow creating a new playlist through an API call.
- Allow retrieving all albums through an API call.
- Allow creating a new album through an API call.
- Allow retrieving usage statistics through an API call.

## Instructions

- In the `STARTER` directory, you will find a `database.sql` file that will serve as the database for your API (changing the database structure is not possible).
- You will also find an `openapi.yaml` file with the documentation in OpenAPI format.
- A `markingtests` folder is also provided, allowing you to test your API.
- The URL of the API documentation will be provided before the start of the module.
- You can use PHP or NodeJS, with or without frameworks from the provided list.
- In case of conflict between the instructions and the documentation or tests, the documentation or tests take precedence.
- If the documentation and tests are in conflict, you can choose to follow either the documentation or the tests.

## Description of Tasks

### API "Signup"

Handles user registration requests for the music streaming service. Allows creating a new registration request, accepting an existing request, and rejecting an existing request.

The list of requests should be sorted in descending order of registration (most recent first).

### API "Songs"

Manages the songs available on the music streaming service. Allows retrieving a list of all songs, adding a new song to the music library, and retrieving a specific song by its unique identifier.

The list of songs should be sorted in alphabetical order by title.

### API "Playlists"

Manages the playlists available on the music streaming service. Allows retrieving a list of all playlists, creating a new playlist by providing necessary information such as title, author, and list of songs in the playlist.

The list of playlists should be sorted in ascending order of registration (oldest first).

### API "Albums"

Manages the albums available on the music streaming service. Allows retrieving a list of all albums and associated titles, and creating a new album by providing necessary information such as title, artist, and album release date.

Albums should be sorted by descending release date (most recent first).
Songs should be sorted alphabetically by title.

### API "Stats"

Allows retrieving usage statistics for the music streaming service: top 3 artists, songs, albums, or the total number of seconds listened.
Statistics are retrieved by specifying the desired type of statistic, optionally the user's identifier, and date ranges (from, to).

## Deliverables

- Functional application in the `/module-b` directory of your web server.
