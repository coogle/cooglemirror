# CoogleMirro

This is the source code for one of my pet projects, CoogleMirror. This PHP application runs on a
Raspberry Pi as a so-called [Magic Mirror](https://www.raspberrypi.org/blog/magic-mirror/). The original
design was based on node.js but I reimplemented the entire thing in PHP and Laravel.

The software package is designed to be modular, using composer to add various features such as:

- Real time drivetime updates
- Dinner menu
- Power consumption of house (using Smappee's APIs)
- Alexa Skills Integration
- News Headlines
- Local Weather
- A clock, obviously
- The ability to display recipes
- Twilio integration (text message the mirror to make it do things)

This code base is a work in progress, constantly being updated as I find more reasons and needs in my
own home. As such, you can expect it to some extent to be a bit unpolished in places. Feel free to submit
PRs to clean that up if you like!

