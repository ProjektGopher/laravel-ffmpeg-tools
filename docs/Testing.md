## Testing
```bash
composer test
```

### Visual Snapshot Testing
#### Easing
To generate plots of all `Ease` methods, from the project root, run
```bash
./scripts/generateEasings
```
The 256x256 PNGs will be generated in the `tests/Snapshots/Easings` directory.
These snapshots will be ignored by git, but allow visual inspection of the plots to
compare against known good sources, like [Easings.net](https://easings.net).

#### Timelines
To generate a video using a `Timeline` with `Keyframes`, from the project root, run
```bash
./scripts/generateTimeline
```
The 256x256 MP4 will be generated in the `tests/Snapshots/Timelines` directory.
These snapshots will also be ignored by git, but again allow for a visual
inspection to ensure they match the expected output.

> **Note** The `scripts` directory _may_ need to have its permissions changed to allow script execution
```bash
chmod -R 777 ./scripts
```
