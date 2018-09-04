# ee cli

Review current EE info, check for updates, or see defined aliases.

### EXAMPLES

    # Display the version currently installed.
    $ ee cli version
    EE 0.24.1

    # Check for updates to EE.
    $ ee cli check-update
    Success: EE is at the latest version.

    # Update EE to the latest stable release.
    $ ee cli update
    You have version 0.24.0. Would you like to update to 0.24.1? [y/n] y
    Downloading from https://github.com/ee/ee/releases/download/v0.24.1/ee-0.24.1.phar...
    New version works. Proceeding to replace.
    Success: Updated EE to 0.24.1.


