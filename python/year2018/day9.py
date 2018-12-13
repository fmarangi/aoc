class Marble:
    def __init__(self, value, prev=None, next=None):
        self.value = value
        self.prev = prev or self
        self.next = next or self

    def insertAfter(self, value):
        marble = Marble(value, self, self.next)
        self.next.prev = marble
        self.next = marble
        return marble

    def delete(self):
        self.prev.next = self.next
        self.next.prev = self.prev
        return self.next

    def rewind(self, n=1):
        i = 0
        marble = self
        while (i < n):
            marble = marble.prev
            i += 1
        return marble

def getWinningScore(players, lastMarble):
    scores = [0] * players
    current = Marble(0)
    i = 1
    while (i < lastMarble):
        if (i % 23 == 0):
            p = (i - 1) % players
            bonus = current.rewind(7)
            scores[p] += i + bonus.value
            current = bonus.delete()
        else:
            current = current.next.insertAfter(i)
        i += 1
    return max(scores)

print getWinningScore(411, 72059 * 100)
