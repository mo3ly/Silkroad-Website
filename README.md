# [Exoria Website] - A Silkroad Online Private Server Web Panel

## Table of Contents
- [Introduction](#introduction)
- [Requirements](#requirements)
- [Features](#features)
  - [User Features](#user-features)
  - [Admin Features](#admin-features)
  - [WIP Features](#wip-features)
- [Installation](#installation)
- [Gallery](#gallery)
- [Contribution](#contribution)
- [License](#license)
- [Acknowledgements](#acknowledgements)

## Introduction
This project was my first venture into open-source back in 2017 and is designed to be a comprehensive web panel for Silkroad Online private servers. It is released on [ElitePvpers](https://www.elitepvpers.com/forum/sro-pserver-guides-releases/4242412-epic-release-new-website-alchemy-system.html). Although not yet fully complete, this web panel is packed with features to manage and enhance your Silkroad Online private server experience.

**Disclaimer**: This project is still under development and might have some bugs or incomplete features. Feel free to contribute!

## Requirements
1. PDO ODBC
2. `_OnlineOffline` table
3. `Evangelion_uniques` table
4. Setup `.htaccess`

## Features

### User Features
- **Login System** with IP ban feature after consecutive failed attempts.
- **Player Ranking** based on accurate item points and sox parts.
- **Guild Ranking**
- **Live Search** for guilds and players.
- **WebMall** with shopping cart, logs, and quantity selection.
- **Web Stall** for players to add items in exchange for gold or silk. Features a hot section for silk items.
- **Account Management** including changing email, secret question, web password, and game password.
- **Inventory and Storage View** for individual players.
- **Item Stars System** to calculate item points based on blues, degree, plus, advance, and seal type.

### Admin Features
- Add items to the WebMall.

### WIP Features
- Forum (badly coded, needs revision)
- Lottery Boxes and Wheel (potential bugs)
- Live notifications

## Installation
1. Setup your database and import `_OnlineOffline` and `Evangelion_uniques` tables.
2. Configure your `.htaccess` file.
3. Install PDO ODBC.
4. Update the database connection settings in the configuration file.
5. Run the setup script.

### Gallery

<img src="https://i.imgur.com/JD5ZEim.png" alt="Description for First Image" width="400">
<img src="https://i.imgur.com/iT5NWpE.png" alt="Description for Second Image" width="400" >
<img src="https://i.imgur.com/TiLDnlg.png" alt="Description for Third Image" width="400">
<img src="https://i.imgur.com/hvt376v.png" alt="Description for Fourth Image" width="400">
<img src="https://i.imgur.com/ywzkODA.png" alt="Description for Fifth Image" width="400" >
<img src="https://i.imgur.com/wqYzOyj.png" alt="Description for Sixth Image" width="400">
<img src="https://i.imgur.com/5kPkvih.png" alt="Description for Seventh Image" width="400">
<img src="https://i.imgur.com/WAHmV38.png" alt="Description for Eighth Image" width="400">

## Contribution
Since this project is far from complete and I am too lazy to finish it myself, contributions are more than welcome! Feel free to fork this repository, make your changes and then create a pull request.

## License
This project is open-source and available under the [MIT License](LICENSE).

## Acknowledgements
This project was made possible through a lot of learning and experimenting, and I hope it helps you as much as it has helped me.
