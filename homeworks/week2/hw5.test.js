var add = require('./hw5')

describe("hw5", function() {
  it("should return correct answer when a=111111111111111111111111111111111111 and b=111111111111111111111111111111111111", function() {
    expect(add('111111111111111111111111111111111111', '111111111111111111111111111111111111')).toBe('222222222222222222222222222222222222')
  })
  it("should return correct answer when a=123 and b=456", function() {
    expect(add('123', '456')).toBe('579')
  })
  it("should return correct answer when a=12312383813881381381 and b=129018313819319831", function() {
    expect(add('12312383813881381381', '129018313819319831')).toBe('12441402127700701212')
  })
  it("should return correct answer when a=129018313819319831 and b=12312383813881381381", function() {
    expect(add('129018313819319831', '12312383813881381381')).toBe('12441402127700701212')
  })
  it("should return correct answer when a=9 and b=9", function() {
    expect(add('9', '9')).toBe('18')
  })
  it("should return correct answer when a=999 and b=1", function() {
    expect(add('999', '1')).toBe('1000')
  })
  it("should return correct answer when a=10 and b=10", function() {
    expect(add('10', '10')).toBe('20')
  })
  it("should return correct answer when a=999 and b=999", function() {
    expect(add('999', '999')).toBe('1998')
  })
})
