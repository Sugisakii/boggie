module.exports = {
  //...
  optimization: {
    splitChunks: {
      // include all types of chunks
      chunks: 'all',
      maxSize: 20000,
      minSize: 10000
    }
  }
};