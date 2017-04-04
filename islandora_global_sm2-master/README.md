# Islandora Global SoundManager2 Player

## Introduction

Creates a full-screen-width audio player at the bottom of the screen that interacts with links to audio files 
on the page.

## Requirements

This module requires the following modules/libraries:

* [SoundManager2](https://github.com/scottschiller/SoundManager2) (see below for installation)

## Installation

Install as usual, see [this](https://drupal.org/documentation/install/modules-themes/modules-7) for further information.

To get the player to show up, you must enable the block `Global SoundManager2 Player`, either at `admin/structure/block`
or in Pages/Panels. It should show up at the footer of the page regardless of what region it's added to. 

The SoundManager2 library must be installed in `sites/all/libraries` such that the javascript files are at 
`sites/all/libraries/soundmanager2/script/soundmanager2.js`. Note that soundmanager2 is lower cased. 

## Configuration

TODO: Implement administrative configuration:
* debug and unminified vs nodebug and minified javascript
* what selector should be used? (currently `.gsm2-playable-link`)

## Usage

Create links on your page with attributes `class="gsm2-playable-link silent"` and `data-source="path/to/mp3.mp3"`. They 
will be added to the playlist and clicking on the link will cause that track to be played in the player. Navigation and 
play/pause can either be done by using the bar-ui player, or by clicking on the links in the text. 

Note that it's a good idea to indicate somehow that the links are playable/playing using the css selectors for 
`.silent` and `.playing`. 

## Maintainer

[Rosie Le Faive](https://github.com/rosiel)

## License

[GPLv3](http://www.gnu.org/licenses/gpl-3.0.txt)

