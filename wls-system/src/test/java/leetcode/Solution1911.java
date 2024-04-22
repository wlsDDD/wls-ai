package leetcode;


import org.junit.jupiter.api.Test;

import java.util.HashMap;
import java.util.Map;

class Solution1911 {
    
    @Test
    void test01() {
        
    }
    
    /**
     * 一个下标从 0开始的数组的 交替和定义为 偶数下标处元素之 和减去 奇数下标处元素之 和。
     * 比方说，数组[4,2,5,3]的交替和为(4 + 5) - (2 + 3) = 4。
     * 给你一个数组nums，请你返回nums中任意子序列的最大交替和（子序列的下标 重新从 0 开始编号）。
     * 一个数组的 子序列是从原数组中删除一些元素后（也可能一个也不删除）剩余元素不改变顺序组成的数组。比方说，[2,7,4]是[4,2,3,7,2,1,4]的一个子序列（加粗元素），但是[2,4,2] 不是。
     * 示例 1：
     * 输入：nums = [4,2,5,3]
     * 输出：7
     * 解释：最优子序列为 [4,2,5] ，交替和为 (4 + 5) - 2 = 7 。
     * 示例 2：
     * 输入：nums = [5,6,7,8]
     * 输出：8
     * 解释：最优子序列为 [8] ，交替和为 8 。
     * 示例 3：
     * 输入：nums = [6,2,1,2,4,5]
     * 输出：10
     * 解释：最优子序列为 [6,1,5] ，交替和为 (6 + 5) - 1 = 10 。
     * 提示：
     * 1 <= nums.length <= 105
     * 1 <= nums[i] <= 105
     */
    public long maxAlternatingSum(int[] nums) {
        int x = 1000000;
        int left = 0;
        int right = 0;
        int max = 0;
        Map<Integer, Integer> map = new HashMap<>();
        for (int i = 0; i < nums.length; i++) {
            if (nums[i] < x) {
                x = nums[i];
                map.put(x, i);
            }
            if (nums[i] > max) {
                max = nums[i];
            }
        }
        for (int i = 0; i < nums.length; i++) {
            Integer j = map.get(x);
            for (int i1 = j - 1; i1 >= 0; i1--) {
                if (nums[i1] > left) {
                    left = nums[i1];
                }
            }
            for (int i1 = j + 1; i1 < nums.length; i1++) {
                if (nums[i1] > right) {
                    right = nums[i1];
                }
            }
        }
        return Math.max(left + right - x, max);
    }
    
}
